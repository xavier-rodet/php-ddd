# php-ddd

DDD example project using PHP &amp; Symfony

TODO:

- créer un premier use case avec CQRS Player RegisterPlayer

## Context Map

Account / Game / Social

### Account

- Anyone can RegisterPublisher [POST] /publisher
- Publisher can UpdatePublisher [PUT] /publisher/:id
- Anyone can ListPublishers [GET] /publisher
- Anyone can RegisterPlayer [POST] /players
- Player can UpdatePlayer [PUT] /players/:id
- Anyone can ListPlayers [GET] /players

### Game

- Store:
  - Publisher can PublishGame : [POST] /games
  - Player can PurchaseCredits : [POST] /players/:id/credits
  - Player can PurchaseGame : [POST] /games/:id/purchase
- Library:
  - Player can ListLibraryGames [GET] /players/:id/games
  - Player can DownloadLibraryGame [GET] /games/:id/download
- Review:
  - Anyone can ListGameReviews [GET] /games/:id/reviews
  - Player can AddReviewToLibraryGame [POST] /games/:id/reviews

### Social

- Player can UpdateStatus [PUT] /players/:id/status
- Player can ListFriends [GET] /players/:id/friends
- Player can AddFriend [POST] /players/:id/friends
- Player can RemoveFriend [DELETE] /players/:id/friends/:id
- Player can SendMessageToFriend [POST] /players/:id/message
