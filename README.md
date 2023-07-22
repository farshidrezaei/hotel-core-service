## setup

### requirements

- mysql
- rabbitMq

### prepare project
after modify and complete env file, run bellow command to prepare services
```bash
    docker compose up -d
```


## usage

- POST `v1/vendors/:vendorId/rooms` => create room 
- PUT `v1/vendors/:vendorId/rooms/:roomId` => update room
- DELETE `v1/vendors/:vendorId/rooms/:roomId` => delete room

an observer is exists on Room Model and observe any modification on that and push that to rabbitMq.

rabbitMq integrated by `larabbitmq` package that i developed it.
