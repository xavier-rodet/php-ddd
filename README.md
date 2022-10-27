# php-ddd

DDD example project using PHP &amp; Symfony

TODO:

- créer un premier use case avec CQRS Player RegisterPlayer

## Context Map

Account / Game / Social

### Account

- Publisher can RegisterPublisher/ UpdatePublisher
- Player can RegisterPlayer / UpdatePlayer
- Anyone can ListPlayers / ListPublishers

### Game

- Store:
  - Publisher can PublishGame
  - Player can PurchaseCredits / PurchaseGame
- Library:
  - Player can ListLibraryGames
  - Player can DownloadLibraryGame
- Review:
  - Anyone can ListGameReviews
  - Player can AddReviewToLibraryGame

### Social

- Player can UpdateStatus
- Player can ListFriends / AddFriend / BlockFriend
- Player can SendMessageToFriend
