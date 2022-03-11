CREATE TABLE user (
    idUser INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pseudoUser VARCHAR(20) NOT NULL,
    passwordUser VARCHAR(32) NOT NULL,
    nameUser VARCHAR(20) NOT NULL,
    firstNameUser VARCHAR(20) NOT NULL,
    emailUser VARCHAR(50) NOT NULL,
    cityUser VARCHAR(20) NOT NULL,
    postalCodeUser VARCHAR(5) NOT NULL,
    adressUser VARCHAR(50) NOT NULL,
    isAdmin TINYINT(1) NOT NULL,
);


CREATE TABLE category (
    idCategory INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nameCategory VARCHAR(20) NOT NULL
);

CREATE TABLE product (
    idProduct INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nameProduct VARCHAR(100) NOT NULL,
    descriptionProduct TEXT NOT NULL ,
    imageProduct VARCHAR(250) NOT NULL,
    priceProduct INT(3) NOT NULL,
    stockProduct INT(3) NOT NULL,
    idCategoryProduct INT(3) NOT NULL,
    FOREIGN KEY (idCategoryProduct) REFERENCES category(idCategory)
);


CREATE TABLE command (
    idCommand INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idUserCommand INT(3) NULL DEFAULT NULL,
    amountCommand INT(3) NOT NULL,
    dateCommand DATETIME NOT NULL,
    stateCommand ENUM('Commande en cours de traitement', 'Commande envoyée', 'Commande livrée') NOT NULL,
    FOREIGN KEY (idUserCommand) REFERENCES user(idUser)
);


CREATE TABLE detailsCommand (
    idDetailsCommand INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idCommandDetailsCommand INT(3) NULL DEFAULT NULL,
    idProductDetailsCommand INT(3) NULL DEFAULT NULL,
    quantityDetailsCommand INT(3) NOT NULL,
    priceDetailsCommand INT(3) NOT NULL,
    FOREIGN KEY(idProductDetailsCommand) REFERENCES product(idProduct),
    FOREIGN KEY(idCommandDetailsCommand) REFERENCES command(idCommand)

);

CREATE TABLE member (
    idMember INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pseudoMember VARCHAR(20) NOT NULL,
    passwordMember VARCHAR(32) NOT NULL,
    nameMember VARCHAR(20) NOT NULL,
    firstMember VARCHAR(20) NOT NULL,
    emailMember VARCHAR(50) NOT NULL,
    cityMember VARCHAR(20) NOT NULL,
    postalCodeMember VARCHAR(5) NOT NULL,
    adressMember VARCHAR(50) NOT NULL,
    isAdmin TINYINT(1) NOT NULL
);













