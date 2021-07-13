```bash
docker build -t leadhandler .
docker run -it --user "$(id -u):$(id -g)" -v $(pwd):/app leadhandler composer install
docker run -it --user "$(id -u):$(id -g)" -v $(pwd):/app leadhandler
```
