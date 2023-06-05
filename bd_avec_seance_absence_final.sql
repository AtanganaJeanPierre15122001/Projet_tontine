CREATE TABLE membre(
   idMembre CHAR(8) ,
   nom VARCHAR(30)  NOT NULL,
   prenom VARCHAR(30) ,
   anneeNais SMALLINT,
   anneeEntree SMALLINT,
   password VARCHAR(50)  NOT NULL,
   sexe CHAR(1)  NOT NULL default 'M',
   telephone1 VARCHAR(15) ,
   email VARCHAR(50) ,
   valide BOOLEAN,
   PRIMARY KEY(idMembre)
);

CREATE TABLE annee(
   annee SMALLINT,
   PRIMARY KEY(annee)
);

CREATE TABLE versementCotis(
   idVers BIGINT AUTO_INCREMENT,
   montant DECIMAL(15,2)   NOT NULL,
   PRIMARY KEY(idVers)
);

CREATE TABLE seance(
   idSeance BIGINT AUTO_INCREMENT,
   dateSeance DATE NOT NULL,
   rapportReunion TEXT,
   PRIMARY KEY(idSeance)
);

CREATE TABLE fonction(
   codeFonction VARCHAR(50) ,
   libelle VARCHAR(50)  NOT NULL,
   idMembre CHAR(8)  NOT NULL,
   annee SMALLINT NOT NULL,
   PRIMARY KEY(codeFonction),
   FOREIGN KEY(idMembre) REFERENCES membre(idMembre),
   FOREIGN KEY(annee) REFERENCES annee(annee)
);

CREATE TABLE aide(
   id_aide BIGINT AUTO_INCREMENT,
   id_m INT NOT NULL,
   date_aide DATE,
   raison VARCHAR(500) ,
   status_aide BOOLEAN,
   idMembre CHAR(8)  NOT NULL,
   idSeance BIGINT NOT NULL,
   PRIMARY KEY(id_aide),
   FOREIGN KEY(idMembre) REFERENCES membre(idMembre),
   FOREIGN KEY(idSeance) REFERENCES seance(idSeance)
);

CREATE TABLE pret(
   idpret INT,
   montant DECIMAL(15,2)   NOT NULL,
   pourcentage INT,
   observations TEXT,
   status BOOLEAN,
   accorder BOOLEAN,
   idMembre_preteur CHAR(8)  NOT NULL,
   idSeance BIGINT NOT NULL,
   PRIMARY KEY(idpret),
   FOREIGN KEY(idMembre_preteur) REFERENCES membre(idMembre),
   FOREIGN KEY(idSeance) REFERENCES seance(idSeance)
);

CREATE TABLE remboursement(
   id BIGINT AUTO_INCREMENT,
   montant DECIMAL(15,2)   NOT NULL,
   idpret INT NOT NULL,
   idSeance BIGINT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(idpret) REFERENCES pret(idpret),
   FOREIGN KEY(idSeance) REFERENCES seance(idSeance)
);

CREATE TABLE cotise(
   idMembre CHAR(8) ,
   idVers BIGINT,
   date_cotis DATE NOT NULL,
   PRIMARY KEY(idMembre, idVers),
   FOREIGN KEY(idMembre) REFERENCES membre(idMembre),
   FOREIGN KEY(idVers) REFERENCES versementCotis(idVers)
);

CREATE TABLE estAbsent(
   idMembre CHAR(8) ,
   idSeance BIGINT,
   present BOOLEAN NOT NULL default false,
   commentaire TEXT,
   PRIMARY KEY(idMembre, idSeance),
   FOREIGN KEY(idMembre) REFERENCES membre(idMembre),
   FOREIGN KEY(idSeance) REFERENCES seance(idSeance)
);

CREATE TABLE bouf(
   idVers BIGINT,
   date_bouf DATE NOT NULL,
   idMembre CHAR(8)  NOT NULL,
   PRIMARY KEY(idVers),
   FOREIGN KEY(idVers) REFERENCES versementCotis(idVers),
   FOREIGN KEY(idMembre) REFERENCES membre(idMembre)
);
