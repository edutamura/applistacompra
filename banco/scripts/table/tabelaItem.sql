CREATE TABLE `listacompras`.`item` (
  `idItem` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(400) NOT NULL,
  `quantidade`  INT NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idItem`),
  UNIQUE INDEX `idItem_UNIQUE` (`idItem` ASC) VISIBLE
  );