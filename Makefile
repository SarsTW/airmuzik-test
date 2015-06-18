HUB_NAME := selenium-hub
NODE_CHROME := chrome-node
NODE_CHROME_DEBUG := chrome-node-debug
NODE_FIREFOX := firefox-node
NODE_FIREFOX_DEBUG := firefox-node-debug
NAME_SELENIUM := selenium
VERSION := 2.46.0
GIT_NAME := airmuzik-test
GIT_URL := https://github.com/gosick/$(GIT_NAME).git
REPOSITORY_PATH := /home/testing/airmuzik-test
TEST_IN_DOCKER_PATH := /airmuzik-test
#HOST := $(shell ifconfig | grep -A 1 'eth0' | tail -1 | cut -d ':' -f 2 | cut -d ' ' -f 1)
HOST := $(shell ifconfig | grep -A 1 'eth0' | head -2 | cut -d ':' -f 2 | cut -d ' ' -f 1 | tail -1)
PORT := 4444

all:

	
	@echo -------------------------------------------------------------------------------
	@echo -- usage:
	@echo --
	@echo --
	@echo \* make install
	@echo \*  =====\> checking docker status, pulls selenium images,
	@echo \*  =====\> pulls test from git, runs selenium hub, chrome debug, firefox debug node
	@echo -------------------------------------------------------------------------------

	@echo \*  make build product=[product image tag name] ex: make build product=air
	@echo \*  =====\> builds test from git folder to docker images
	@echo -------------------------------------------------------------------------------

	@echo \*  make test product=[product image tag name] test=[test name]ex: make test product=air test=air1
	@echo \*  =====\> runs test , if does not exist test images, do nothing
	@echo -------------------------------------------------------------------------------

	@echo \*  Label do:
	@echo \*
	@echo \*  check_docker_install:
	@echo \*  =====\> checks operating system is Linux, and checks docker installation
	@echo \*
	@echo \*  run_hub:
	@echo \*  =====\> checks hub container existence, and run or restart hub
	@echo \*
	@echo \*  run_selenium:
	@echo \*  =====\> will check run_hub and then check node status to run or restart
	@echo \*
	@echo \*  pull_test_from_git:
	@echo \*  =====\> git clone the test, see GIT_NAME and GIT_URL
	@echo \*
	@echo \*  pull_selenium:
	@echo \*  =====\> pull selenium images
	@echo \*
	@echo \*  docker_uninstall:
	@echo \*  =====\> uninstall docker.io
	@echo -------------------------------------------------------------------------------


install: check_docker_install pull_selenium pull_test_from_git run_selenium



check_docker_install:

ifeq "$(shell uname -s)" "Linux"

ifeq "$(shell which docker)" ""

	@echo can not find docker, now installing docker
	@sudo apt-get update
	@sudo apt-get install -y docker.io

else

	@echo docker has installed

endif

endif


run_hub:

ifneq "$(shell sudo docker inspect '$(HUB_NAME)' | grep 'Image' |  grep '$(NAME_SELENIUM)/hub:$(VERSION)')" ""

	@echo selenium hub container exists, check container status

ifneq "$(shell sudo docker inspect '$(HUB_NAME)' | grep 'Running' | grep 'false')" ""

	@echo selenium hub container exited, restarting hub
	@sudo docker restart $(HUB_NAME)

else

	@echo selenium hub container is running

endif

else

	@echo selenium hub container does not exist, starts selenium hub
	@sudo docker run -d -p $(PORT):$(PORT) --name $(HUB_NAME) $(NAME_SELENIUM)/hub:$(VERSION)

endif


run_selenium: run_hub

ifneq "$(shell sudo docker inspect '$(NODE_CHROME_DEBUG)' | grep 'Image' | grep '$(NAME_SELENIUM)/node-chrome-debug:$(VERSION)')" ""

	@echo chrome debug node container exists, check container status

ifneq "$(shell sudo docker inspect '$(NODE_CHROME_DEBUG)' | grep 'Running' | grep 'false')" ""

	@echo chrome debug node container exited, restarted chrome debug node
	@sudo docker restart $(NODE_CHROME_DEBUG)

else

	@echo chrome debug node container is running

endif

else

	@echo chrome debug node container does not exist, starts chrome debug node
	@sudo docker run -d --link $(HUB_NAME):hub --name $(NODE_CHROME_DEBUG) $(NAME_SELENIUM)/node-chrome-debug:$(VERSION)

endif

ifneq "$(shell sudo docker inspect '$(NODE_FIREFOX_DEBUG)' | grep 'Image' | grep '$(NAME_SELENIUM)/node-firefox-debug:$(VERSION)')" ""

	@echo firefox debug node container exists, check container status

ifneq "$(shell sudo docker inspect '$(NODE_FIREFOX_DEBUG)' | grep 'Running' | grep 'false')" ""

	@echo firefox debug node container exited, restarted firefox debug node
	@sudo docker restart $(NODE_FIREFOX_DEBUG)

else

	@echo firefox debug node container is running

endif

else
	
	@echo firefox debug node container does not exist, starts firefox debug node
	@sudo docker run -d --link $(HUB_NAME):hub --name $(NODE_FIREFOX_DEBUG) $(NAME_SELENIUM)/node-firefox-debug:$(VERSION)

endif

build:


ifeq "$(shell sudo docker inspect '$(product)' | grep 'Image')" ""

	@cd $(GIT_NAME)/$(product) && sudo docker build -t $(product) .

endif

pull_test_from_git:


	@echo pull test from $(GIT_URL)
	@-git clone $(GIT_URL)

test: run_selenium


ifneq "$(shell sudo docker inspect '$(test)' | grep 'Image' | grep '$(product)')" ""

	@echo $(test) container exist, check container status

ifneq "$(shell sudo docker inspect '$(test)' | grep 'Running' | grep 'false')" ""

	@echo $(test) container exited, restart $(test)
	@sudo docker restart $(test)

else

	@echo $(test) container is running

endif

else

	@echo $(test) container does not exist, starts $(test)
	@#@sudo docker run -d -v $(REPOSITORY_PATH):$(TEST_IN_DOCKER_PATH) -e host=$(HOST) -e port=$(PORT) --name $(test) $(product)
	@sudo docker run -i -t -v $(REPOSITORY_PATH):$(TEST_IN_DOCKER_PATH) -e host=$(HOST) -e port=$(PORT) --name $(test) $(product) /bin/bash

endif

run_node_chrome_debug:


	@-sudo docker run -d -P --link $(HUB_NAME):hub --name $(NODE_CHROME_DEBUG) $(NAME_SELENIUM)/node-chrome-debug:$(VERSION)

run_node_firefox_debug:


	@-sudo docker run -d -P --link $(HUB_NAME):hub --name $(NODE_FIREFOX_DEBUG) $(NAME_SELENIUM)/node-firefox-debug:$(VERSION)

pull_selenium: hub node_chrome node_chrome_debug node_firefox node_firefox_debug


hub:


	@sudo docker pull $(NAME_SELENIUM)/hub:$(VERSION)

node_chrome:


	@sudo docker pull $(NAME_SELENIUM)/node-chrome:$(VERSION)

node_firefox:

	
	@sudo docker pull $(NAME_SELENIUM)/node-firefox:$(VERSION)

node_chrome_debug:


	@sudo docker pull $(NAME_SELENIUM)/node-chrome-debug:$(VERSION)

node_firefox_debug:

	
	@sudo docker pull $(NAME_SELENIUM)/node-firefox-debug:$(VERSION)

docker_uninstall:


	@sudo apt-get autoremove -y docker.io


