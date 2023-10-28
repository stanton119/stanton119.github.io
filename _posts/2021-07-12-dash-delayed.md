---
layout: post
title: "Parallel general functions using Dask"
tags: [data]
color: red
comments: true
---

Dask is commonly used for data processing in parallel compute.
However I wanted to quickly explore using `dask` for parallel processing of generic python functions.

Full script available at:
[https://github.com/stanton119/data-analysis/tree/master/tools_python/parallel_processing/dask_vs_multiprocessing.py](https://github.com/stanton119/data-analysis/tree/master/tools_python/parallel_processing/dask_vs_multiprocessing.py)

This can apply to functions like making http requests etc..
If we need to make a series of requests, running those within a for loop etc. would be fairly slow as we wait for a response for each call before moving on.

For this quick example we can make a http request, or to make it more fair we can mock that with a simple sleep command:
```python
def fetch_results(date):
    date_str = date.strftime("%Y-%m-%d")
    r = requests.get(
        f"https://api.carbonintensity.org.uk/intensity/date/{date_str}"
    )
    return r.json()


def fetch_results_mock(date):
    time.sleep(0.2)
    return date

fcn = fetch_results
params = pd.date_range(datetime(2020, 1, 1), periods=20).tolist()
```

For a baseline we can run the above query with a `for loop` and also the `map` command to iterate through the list of dates sequentially.
```python
# for loop
t1 = timeit.default_timer()
results_for = list()
for param in params:
    results_for.append(fcn(param))
t2 = timeit.default_timer()
t_for = t2 - t1
print(f"For loop: {t_for:.1f}")

# map
t1 = timeit.default_timer()
results_map = list(map(fcn, params))
t2 = timeit.default_timer()
t_map = t2 - t1
print(f"Map: {t_map:.1f}")
```

These do the same thing so no surprises that they return similar times:
```
For loop: 4.1
Map: 4.1
```

Now let's parallelise the calls. We could typically use `multiprocessing` to split out the jobs and combine them at the end. 
Multiprocessing requires some particular code design, which can make it slightly more cumbersome when doing interactive exploration.
Also to note, `multiprocessing` doesn't seem to work well with Jupyter sessions/ipython - [StackOverflow](https://stackoverflow.com/questions/48846085/python-multiprocessing-within-jupyter-notebook).
```python
# multiprocessing
mp = multiprocessing.Pool(8)
t1 = timeit.default_timer()
results_mp = mp.map(fcn, params)
t2 = timeit.default_timer()
t_mp = t2 - t1
print(f"Multiprocessing: {t_mp:.1f}")
```
By running in parallel with 8 nodes we see a speed up:
```
Multiprocessing: 1.6
```

Using `dask` seemed a bit easier.
We use the `dask.delayed` function call to take in a generic python function.
This allows it to be distributed to the various `dask` nodes.
We can then call it as normal with the list of dates.

In this case I'm running it locally should the nodes will spin up when needed locally.
Dask uses delayed computation, so the processing only takes place when we need the results.
Here I wanted them straight back, so we call the `dask.compute` function to start the processing.

```python
# dask
t1 = timeit.default_timer()
results_dask = list(map(dask.delayed(fcn), params))
results_dask = dask.compute(results_dask)[0]
t2 = timeit.default_timer()
t_dask = t2 - t1
print(f"Dask: {t_dask:.1f}")
```
We similarly get a good improvement in time compared to the sequential processing.
```
Dask: 0.6
```
The difference between `multiprocessing` and `dask` may not be too repeatable.
The time spent processing in either case will depend on the number of nodes we spin up.
The start the multiprocessing pool can take some time so I left it out the timing loop.
Dask may do this at import or not, if it does not, then it seems to be quite quick...

In summary - to setup parallel work in `dask` is easy, and more straight forward than `multiprocessing`.