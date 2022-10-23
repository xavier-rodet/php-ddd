# php-ddd

DDD example project using PHP &amp; Symfony

TODO:

- créer un premier use case avec CQRS Player RegisterPlayer

## Context Map

Account / Game / Social

### Account

- Publisher can RegisterPublisher/ UpdatePublisher
- Player can RegisterPlayer / UpdatePlayer

### Game

- Store:
  - Publisher can PublishGame
  - Player can PurchaseCredits / PurchaseGame
- Library:
  - Player can SeeLibraryGames
  - Player can DownloadLibraryGame
- Review:
  - Anyone can SeeGameReviews
  - Player can AddReviewToLibraryGame

### Social

- Player can UpdateStatus
- Player can SeeFriends / AddFriend / BlockFriend
- Player can SendMessageToFriend
