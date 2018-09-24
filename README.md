# New DAC Site
This is a repo for a storing a new WordPress installation for the SIGGRAPH DAC. The wp_data and db_data allows for persistent storage. Most importantly, the WordPress theme used here is located in **wp_data/wp-content/themes/dacsite**.

## Requirements

- [Git](https://git-scm.com/)
- [Docker](https://git-scm.com/)

### On Mac
Install Homebrew: 
```bash
/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
```

Install Git
```bash
brew install git
```

Install Docker
```bash
brew install docker
```

### On Windows
Just download the Git and Docker executables from the requirements links above and use Git bash for the following commands. 

## Running
Download the **dacsite** repository from GitHub.

```bash
git clone https://github.com/siggraphdac/dacsite
```

Move into the **dacsite** directory.

```bash
cd dacsite
```

Make sure Docker is running, then start a Docker Swarm.

```bash
docker swarm init
```
Afterwards, deploy the WordPress stack.

```bash
docker stack deploy dacsite -c stack.yml
```

Finally, you should be able to open a browser window and navigate to http://127.0.0.1:8080.

## Editing
If you use Visual Studio Code you can run the following to open up a new session.

```bash
code .
```

The theme and plugins used are under the wp-content in the wp_data directory.