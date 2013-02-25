Ag.Shop
====

TYPO3 Flow package to show how Ag.Event and the use of domain events can improve design and avoid anemic domain models and increase seperation of concerns.

This is example is thought of as a playground and intended for teaching/referencing of domain driven design principles.

A lot of inspiration from the book: https://vaughnvernon.co/?page_id=168

# The example shows among other things:
- The use of modules that communicates using application services and shares information using value objects
- The use of aggregates to ensure invariants (such as the in stock property on inventory items)
- The use of optimistic locking on aggregates with @ORM\Version (to avoid two concurrent processes overwrite each others changes to an aggregate)
- The use of domain events to communicate between aggregates
- Eventuel consistency between aggregates using domain events
- Transactional persistence (changes within an aggregate + the corresponding published events are persisted in the same transaction).