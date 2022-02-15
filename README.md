# imaginacms-iauctions

## Install
```bash
composer require imagina/iauctions-module=v8.x-dev
```

## Enable the module
```bash
php artisan module:enable Iauctions
```
## Seeder

```bash
php artisan module:seed Iauctions
```
## Short Description Module

### Auction - Types
	- INVERSE[0] (Default) = The module automatically chooses the winner
	- OPEN[1] = The winner is chosen manually

### Auction - Status
	- INACTIVE[0] (Default) = When the auction is created (it has not started yet)
	- ACTIVE[1] = When the auction starts
	- FINISHED[2] = When the auction ends

### Bid - Status
	- RECEIVED[0] (Default) = When a bid is created
	- DECLINED[1] = A bid may be declined by the administrator if necessary

### Category - Bid Service
	The categories can have a service for the calculation of points of the bid, if it does not have it, the amount of the bid sent will be taken
