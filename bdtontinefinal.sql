CREATE TABLE annee(
   annee INT,
   PRIMARY KEY(annee)
);

CREATE TABLE versementCotis(
   idVers BIGINT AUTO_INCREMENT,
   montant_Ver DECIMAL(15,2)   NOT NULL,
   photoCotis VARCHAR(50)  NOT NULL,
   deux_vers INT NOT NULL,
   PRIMARY KEY(idVers)
);

CREATE TABLE seance(
   idSeance BIGINT AUTO_INCREMENT,
   dateSeance DATE NOT NULL,
   rapportReunion TEXT,
   PRIMARY KEY(idSeance)
);

CREATE TABLE reuinion(
   Id_reunion VARCHAR(10) ,
   But_et_regles VARCHAR(500) ,
   Nom_reuinion VARCHAR(50)  NOT NULL,
   Nb_max INT NOT NULL,
   Montant_individuel DECIMAL(15,3)   NOT NULL,
   jour_depart DATE NOT NULL,
   montant_ver INT NOT NULL,
   PRIMARY KEY(Id_reunion)
);

CREATE TABLE caisseBouf(
   id_bouf VARCHAR(50) ,
   montant_total DECIMAL(15,3)  ,
   PRIMARY KEY(id_bouf)
);

CREATE TABLE membre(
   idMembre CHAR(8) ,
   nom VARCHAR(30)  NOT NULL,
   prenom VARCHAR(30) ,
   dateNais DATE,
   anneeEntree SMALLINT,
   password VARCHAR(50)  NOT NULL,
   sexe CHAR(1)  NOT NULL default 'M',
   telephone1 VARCHAR(15) ,
   email VARCHAR(50) ,
   photo VARCHAR(50) ,
   Id_reunion VARCHAR(10)  NOT NULL,
   PRIMARY KEY(idMembre),
   FOREIGN KEY(Id_reunion) REFERENCES reuinion(Id_reunion)
);

CREATE TABLE pret(
   idpret INT,
   montant_pret DECIMAL(15,2)   NOT NULL,
   pourcentage INT,
   observations TEXT,
   idMembre_preteur CHAR(8)  NOT NULL,
   idSeance BIGINT NOT NULL,
   PRIMARY KEY(idpret),
   FOREIGN KEY(idMembre_preteur) REFERENCES membre(idMembre),
   FOREIGN KEY(idSeance) REFERENCES seance(idSeance)
);

CREATE TABLE remboursement(
   id BIGINT AUTO_INCREMENT,
   montant_remb DECIMAL(15,2)   NOT NULL,
   photoRem VARCHAR(50)  NOT NULL,
   idpret INT NOT NULL,
   idSeance BIGINT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(idpret) REFERENCES pret(idpret),
   FOREIGN KEY(idSeance) REFERENCES seance(idSeance)
);

CREATE TABLE fonction(
   codeFonction VARCHAR(50) ,
   libelle VARCHAR(50)  NOT NULL,
   idMembre CHAR(8)  NOT NULL,
   annee INT NOT NULL,
   PRIMARY KEY(codeFonction),
   FOREIGN KEY(idMembre) REFERENCES membre(idMembre),
   FOREIGN KEY(annee) REFERENCES annee(annee)
);

CREATE TABLE aide(
   Id_aide BIGINT AUTO_INCREMENT,
   date_aide DATE,
   raison VARCHAR(500) ,
   montant_aide DECIMAL(15,2)  ,
   idMembre CHAR(8)  NOT NULL,
   idSeance BIGINT NOT NULL,
   PRIMARY KEY(Id_aide),
   FOREIGN KEY(idMembre) REFERENCES membre(idMembre),
   FOREIGN KEY(idSeance) REFERENCES seance(idSeance)
);

CREATE TABLE Requete(
   Id_Requette BIGINT AUTO_INCREMENT,
   Motif TEXT,
   Montant INT,
   DateReq DATE,
   status CHAR(1)  NOT NULL,
   codeFonction VARCHAR(50)  NOT NULL,
   idMembre CHAR(8)  NOT NULL,
   PRIMARY KEY(Id_Requette),
   FOREIGN KEY(codeFonction) REFERENCES fonction(codeFonction),
   FOREIGN KEY(idMembre) REFERENCES membre(idMembre)
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
   idMembre CHAR(8) ,
   id_bouf VARCHAR(50) ,
   date_bouf DATE NOT NULL,
   PRIMARY KEY(idMembre, id_bouf),
   FOREIGN KEY(idMembre) REFERENCES membre(idMembre),
   FOREIGN KEY(id_bouf) REFERENCES caisseBouf(id_bouf)
);
