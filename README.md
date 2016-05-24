# Symfony example of domain driven design and hexagonal architecture

The following is an example of implementing domain driven design, employing hexagonal architecture to separate 
the domain logic from Symfony framework integration.

The domain logic is located in src/Todo, whilst the integration with Symfony is located in src/TodoBundle.

## Testing
To express and test the domain logic I have used [phpspec](http://www.phpspec.net), whilst integrations with the Symfony bundle 
such as those in TodoBundle use PHPUnit.
