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

# Api Examples


## Auctions

###List all auctions
 
with status **Draft**=0, **Pending**=1, **Published**=2, **Finished**=3

```
https://mydomain.com/api/iauctions/auctions?filter={"order":{"field":"created_at","way":"asc"},"status":[1,2,3]}&include=product,ingredient&take=12&page=1
```
whit order random

```
https://mydomain.com/api/iauctions/auctions?filter={"order":random,"status":[1,2,3]}&include=product,ingredient&take=12&page=1
```

List provider's auctions whit status **Pending**=0, **Pending**=1 **rejected**=2
```
https://mydomain.com/api/iauctions/auctions?filter={"provider":{"id":1,"status":1}}&include=product,ingredient&take=12&page=1
```

participar en una lisitacion

```
https://mydomain.com/api/iauctions/auctions/1/join
```

```$xslt
{
"products":{1,2,3}
}
```

Data if is admin
```
 'auction_id',
 'provider_id',
 'status',
```

List provider's auctions product

```$xslt
https://mydomain.com/api/iauctions/auctions/providers/1?include=products
```

## Products

###List all products

with status **Active**=0, **Inactive**=1
```$xslt
https://mydomain.com/api/iauctions/products?filter={"order":{"field":"created_at","way":"asc"},"status":[0,1]}&include=product,ingredient&take=12&page=1

filter{
"order":{"field":"created_at","way":"asc"} // name, concentration, status, created_at, updated_at
"concentration":{"min":0,"max":25"}
"ingredient":1 //Id of active ingredient
"search":"value"
"status":[0,1]
}
includes=ingredient,autionProfiders,auctions
```
--

#### List provider's auctions (Example with status = PENDING,PUBLISHED,FINISHED)
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
