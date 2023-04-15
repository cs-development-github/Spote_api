
# Spote

Spote was born from a collective idea, that of creating an application that allows to promote local tourism through a modern tool, the project has seen the days. The team consists of 4 people at the moment.

The heart of the application is to allow users to geolocate the different events available around them through an interactive map and find people with the same interests in order not to go alone and or cancel. The goal is to create a circle of friends with the same interests to attend these different events.

## Deployment

To deploy the project,
You need to git clone the project to the right folder and then run the following commands  
In a terminal

```bash
  docker compose up -d
```

Then you have to go to the terminal specific to the php8 docker container

```bash
  cd Spote_api
  composer install  
  symfony:serve:ca:install
  symfony:serve
```

That's it for the initialization of the project


For the other times you just have to turn on docker and run the following commands

```bash
  symfony:serve
```

You are free to edit the .env of the project, but don't forget to edit the same in the dockerFile
