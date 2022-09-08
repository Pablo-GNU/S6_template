### Requirements ###

- docker: **20**

### Install ###

On the project root execute this commands:

````
cp docker-compose.override.yml.dist docker-compose.override.yml

make docker-build

make docker-start

make composer-install
````

### Usage ###

Now you can access with a web browser to these endpoints:

* http://localhost:8080/test

### Stop ###

To stop the containers use this

```
make docker-stop
```

### ENJOY ###
