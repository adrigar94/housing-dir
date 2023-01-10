# Housing dir

This is a Symfony project that I created to practice using Symfony and some concepts of Domain-Driven Design (DDD) such as hexagonal architecture, Command Query Responsibility Segregation (CQRS), and domain events.

The project is called "Housing Dir" and it is an API for storing and querying properties for a real estate agency. This project includes a docker-compose.yml file that configures the environment and a script called **manage.sh to run some helpful commands**.


```bash
./manage.sh prepare # prepare dependencies and configurations, this command will install docker if necessary
./manage.sh start # start the Docker containers
./manage.sh tests # run all the tests
```

This will start the necessary containers and run all the tests.

The project makes use of several DDD concepts, such as hexagonal architecture, which separates the application's core domain from the infrastructure. This allows for the domain to be easily tested and reused in different contexts. Additionally, the project uses CQRS to separate the concerns of handling commands and queries, making the code more maintainable. Finally, it implements domain events to allow for loose coupling between domain objects.

Feel free to take a look at the code and see how these concepts are implemented in the project. Feel free to use or adapt it, but be sure to give credit if you want to make this available.

**Note**: If you have any issues or doubts please contact the developer, this script was created only for this particular project, it's possible to have some issue on your specific case.