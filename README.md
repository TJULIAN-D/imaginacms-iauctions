# asgardcms-iauctions

## Auctions Status
    - DRAFT = 0;
    - PENDING = 1;
    - PUBLISHED = 2;
    - FINISHED = 3;

## General Status (For Products and other else)
    - PENDING = 0;
    - APPROVED = 1;
    - REJECTED = 2;

## Api Examples

### Auctions

#### List all auctions (with status = PENDING,PUBLISHED,FINISHED)
https://mydomain.com/api/iauctions/auctions?page=1&take=10&filter={"orderBy":"started_at","orderType":"asc","status":[1,2,3]}&include=product,category,ingredient

#### Get an auction (Example 4 -> id)
https://mydomain.com/api/iauctions/auctions/4?include=product,category,ingredient


### Product

#### List all Products (with status = APPROVED)
https://mydomain.com/api/iauctions/products?page=1&take=10&filter={"status":[1]}&include=category,ingredient

#### Get a product (Example capsulagro -> slug)
https://mydomain/api/iauctions/products/capsulagro?include=category,ingredient

### Auction Provider

// Registrarse en un auction

- Verificar las Fechas

### Auction Provider Product

// Registrar los productos en un auction

- Verificar las Fechas

### Bid

// Listar todos los Bids

// Ver la informacion de un Bid

// Guardar un Bid

 - Verificar la fecha del auction
 - Verificar el estatus del auction