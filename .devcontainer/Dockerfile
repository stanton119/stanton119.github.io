# [Choice] Debian OS version (use bullseye on local arm64/Apple Silicon): bullseye, buster
ARG VARIANT=bullseye
FROM mcr.microsoft.com/vscode/devcontainers/jekyll:0-${VARIANT}

# install updated ruby version
RUN sudo apt-get update && sudo apt-get -y install ruby-full
