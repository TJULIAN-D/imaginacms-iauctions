# asgardcms-iauctions

## Auctions Status
    - DRAFT = 0;
    - PENDING = 1;
    - PUBLISHED = 2;
    - FINISHED = 3;

## General Status (For Products, AuctionProviders and other else)
    - PENDING = 0;
    - APPROVED = 1;
    - REJECTED = 2;

## Api Examples


### Auctions

#### List all auctions (Example with status = PENDING,PUBLISHED,FINISHED)
https://mydomain.com/api/iauctions/auctions?page=1&take=10&filter={"orderBy":"started_at","orderType":"asc","status":[1,2,3]}&include=product,category,ingredient

#### Get an auction (Parameter = auctionid)
https://mydomain.com/api/iauctions/auctions/4?include=product,category,ingredient


### Product

#### List all Products (with status = APPROVED)
https://mydomain.com/api/iauctions/products?page=1&take=10&filter={"status":[1]}&include=category,ingredient

#### Get a product (Parameter = productslug)
https://mydomain.com/api/iauctions/products/capsulagro?include=category,ingredient


### Auction Provider (with products)

#### Get a AuctionProvider (Parameter = auctionproviderid)
https://mydomain.com/api/iauctions/auctionproviders/4?include=products

#### Get a AuctionProvider By Auction and User(Parameter = auctionid)
https://mydomain.com/api/iauctions/auctionproviders/auction/4?include=products

#### Store (Parameters = auctionid, Products ids)
https://mydomain.com/api/iauctions/auctionproviders/auction/4?productsid=1,2


### Bid

#### List All bids (Example with AuctionID = 4)
https://mydomain.com/api/iauctions/bids?take=10&filter={"AuctionID":4}&include=auction,product

#### Get a Bid (Parameter = bidid)
https://mydomain.com/api/iauctions/bids/3?include=auction,product

#### Store (Parameters = auctionid, Bid Parameters)
https://mydomain.com/api/iauctions/bids/auction/4


## Email Templates

### Admin

#### Principal
Themes/Adminlte/views/email/plantilla.blade

#### Auction Provider Status
views/email/auctionprovider_status


## Cron to Dates
