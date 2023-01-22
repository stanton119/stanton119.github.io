---
layout: post
title: "GitHub Pages - Moving from a fork to a remote theme"
tags: []
color: red
comments: true
---

I've recently moved this GitHub Pages blog from to a remote theme.
This blog runs on the [Jekyll](https://jekyllrb.com) blogging platform. You write posts and pages in markdown and use a theme to render them into a nice website. The theme I used for the blog was [Type-on-Strap](https://github.com/sylhare/Type-on-Strap). To install the theme I followed the normal instructions of forking the repo before making any changes, such as writing posts or making new pages.

## What's the problem?
Firstly this means your blog repo contains all the theme files. So it's harder to determine what consists of your content versus the theme. And secondly, to get updates from the upstream theme repo was not easy. All my posts and changes were git commits on top of that previous fork. That means my website git repo has diverged from the theme. To get an update I have to create a pull request from the upsteam theme branch. As it's common for the two repos to be so different, GitHub will usually not be able to auto merge the pull request. So this needs to be down offline.

Merging from the theme master branch is a process of setting a new remote: `git remote add ...`. Then merging the branch into my repo master branch. As this can't be auto-merged, you would then go through all the conflicts. And that takes a long time... This time around I haven't merged from the theme branch in a few years and the effort to merge the changes was too great. So I looked for other solutions.

## What's the alternative?
You can typically use themes by ruby gems or by setting a remote-theme in the jekyll config file. Both approaches allow us to make local overwrites to parts of the theme via the config and other files, so we can still make changes as if we had forked the theme repo. Using a gem would allow us to pin a particular version, so any changes to the remote-theme will not change our blog. The remote-theme option is specific to GitHub Pages and will keep the blog aligned with the latest version of the remote-theme. I've decided to use the remote-theme config option, as I'm quite lazy updating the blog theme.

## How to make the change?
To use a remote-theme we need to specify in the repo `_config.yml` as follows:
```
remote_theme: sylhare/Type-on-Strap
```

Next was the process of clearing out the repo so that only the posts and pages of the blog were left, and we have removed the theme assets etc.. I found this easiest by creating a new branch and starting from a new fresh Jekyll blog. I then copied in all the posts and pages and their dependencies (.js, .css, .png etc.).

As we're making a lot of potentially breaking changes, it made sense to test all this locally. I did this via Docker within a VSCode `.devcontainer`. The container was based off a [Microsoft Jekyll image](https://github.com/devcontainers/images/tree/main/src/jekyll). To make it function with GitHub Pages, I simply followed the instruction at [GitHub to create a Jekyll site](https://docs.github.com/en/pages/setting-up-a-github-pages-site-with-jekyll/creating-a-github-pages-site-with-jekyll#creating-your-site). I could then serve the site locally and play around with the config and the content to ensure it works fine.

Once I had a working local copy I published that branch to the blog remote repo at GitHub and changed switched the blog to use that branch for the actual website. Then I can check online that it also works, which it did. Next we merge the branch back into the main master branch and re-publish from there.

Now going forwards the blog repo is much cleaner, but also as it's no longer tied to one theme, it's much easier to change to a different theme. This is largely just a case of changing the value in `_config.yml` to another remote-theme which is compatible.

Until now the blog repo still says it's a fork from the original theme. So the final step was to ask GitHub to remove the fork info from the blog repo. This is not automatic but was fairly straight forward by asking the [GitHub virtual assistant](https://support.github.com/contact?tags=rr-forks&subject=Detach%20Fork&flow=detach_fork) who can help here. It took a few hours for someone to reply to that request. I did notice it leaves the contributors aligned with the theme repo, so it's not perfect, but good enough for me.

You can inspect the resulting repo via [GitHub here](https://github.com/stanton119/stanton119.github.io/tree/4d85912b2a2de7122bd62cdf6ac33272adb0f350).