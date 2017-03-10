#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: oeuvre
#------------------------------------------------------------

CREATE TABLE oeuvre(
        cote          int (11) Auto_increment  NOT NULL ,
        titre         Varchar (25) ,
        date_parution Date ,
        auteur_id     Int ,
        prix          Int ,
        type          Varchar (25) ,
        PRIMARY KEY (cote )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: mot_clefs
#------------------------------------------------------------

CREATE TABLE mot_clefs(
        id  int (11) Auto_increment  NOT NULL ,
        nom Varchar (25) NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: exemplaire
#------------------------------------------------------------

CREATE TABLE exemplaire(
        num       int (11) Auto_increment  NOT NULL ,
        oeuvre_id Int NOT NULL ,
        etat      Bool ,
        cote      Int ,
        idEdit    Int NOT NULL ,
        idRa      Int NOT NULL ,
        PRIMARY KEY (num )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: auteur
#------------------------------------------------------------

CREATE TABLE auteur(
        id             int (11) Auto_increment  NOT NULL ,
        nom            Varchar (25) NOT NULL ,
        prenom         Varchar (25) NOT NULL ,
        date_naissance Date NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: evenement
#------------------------------------------------------------

CREATE TABLE evenement(
        NumEv  int (11) Auto_increment  NOT NULL ,
        TypeEv Int NOT NULL ,
        DateEv Date NOT NULL ,
        LieuEv Varchar (25) NOT NULL ,
        PRIMARY KEY (NumEv )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: adhérent
#------------------------------------------------------------

CREATE TABLE adherent(
        AdId        int (11) Auto_increment  NOT NULL ,
        AdNom       Varchar (25) NOT NULL ,
        AdAdresse   Varchar (25) ,
        AdAdhesion  Date NOT NULL ,
        AdNaissance Date NOT NULL ,
        AdTel       Int NOT NULL ,
        AdMail      Varchar (25) NOT NULL ,
        AdPaiement  Date NOT NULL ,
        PRIMARY KEY (AdId )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: editeur
#------------------------------------------------------------

CREATE TABLE editeur(
        idEdit  int (11) Auto_increment  NOT NULL ,
        nomEdit Varchar (25) NOT NULL ,
        PRIMARY KEY (idEdit )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: rayon
#------------------------------------------------------------

CREATE TABLE rayon(
        idRa      int (11) Auto_increment  NOT NULL ,
        domaineRa Varchar (25) NOT NULL ,
        PRIMARY KEY (idRa )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: type
#------------------------------------------------------------

CREATE TABLE type(
        id          int (11) Auto_increment  NOT NULL ,
        Nom         Varchar (25) ,
        Description Varchar (25) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: appartient
#------------------------------------------------------------

CREATE TABLE appartient(
        cote Int NOT NULL ,
        id   Int NOT NULL ,
        PRIMARY KEY (cote ,id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: participe
#------------------------------------------------------------

CREATE TABLE participe(
        AdId  Int NOT NULL ,
        NumEv Int NOT NULL ,
        PRIMARY KEY (AdId ,NumEv )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: creer
#------------------------------------------------------------

CREATE TABLE creer(
        cote Int NOT NULL ,
        id   Int NOT NULL ,
        PRIMARY KEY (cote ,id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reserve
#------------------------------------------------------------

CREATE TABLE reserve(
        dateReservation Date ,
        cote            Int NOT NULL ,
        AdId            Int NOT NULL ,
        PRIMARY KEY (cote ,AdId )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commande
#------------------------------------------------------------

CREATE TABLE commande(
        dateCommande Date ,
        AdId         Int NOT NULL ,
        cote         Int NOT NULL ,
        PRIMARY KEY (AdId ,cote )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: type_evenement
#------------------------------------------------------------

CREATE TABLE type_evenement(
        id    Int NOT NULL ,
        NumEv Int NOT NULL ,
        PRIMARY KEY (id ,NumEv )
)ENGINE=InnoDB;

ALTER TABLE exemplaire ADD CONSTRAINT FK_exemplaire_cote FOREIGN KEY (cote) REFERENCES oeuvre(cote);
ALTER TABLE exemplaire ADD CONSTRAINT FK_exemplaire_idEdit FOREIGN KEY (idEdit) REFERENCES editeur(idEdit);
ALTER TABLE exemplaire ADD CONSTRAINT FK_exemplaire_idRa FOREIGN KEY (idRa) REFERENCES rayon(idRa);
ALTER TABLE appartient ADD CONSTRAINT FK_appartient_cote FOREIGN KEY (cote) REFERENCES oeuvre(cote);
ALTER TABLE appartient ADD CONSTRAINT FK_appartient_id FOREIGN KEY (id) REFERENCES mot_clefs(id);
ALTER TABLE participe ADD CONSTRAINT FK_participe_AdId FOREIGN KEY (AdId) REFERENCES adherent(AdId);
ALTER TABLE participe ADD CONSTRAINT FK_participe_NumEv FOREIGN KEY (NumEv) REFERENCES evenement(NumEv);
ALTER TABLE creer ADD CONSTRAINT FK_creer_cote FOREIGN KEY (cote) REFERENCES oeuvre(cote);
ALTER TABLE creer ADD CONSTRAINT FK_creer_id FOREIGN KEY (id) REFERENCES auteur(id);
ALTER TABLE reserve ADD CONSTRAINT FK_reserve_cote FOREIGN KEY (cote) REFERENCES oeuvre(cote);
ALTER TABLE reserve ADD CONSTRAINT FK_reserve_AdId FOREIGN KEY (AdId) REFERENCES adherent(AdId);
ALTER TABLE commande ADD CONSTRAINT FK_commande_AdId FOREIGN KEY (AdId) REFERENCES adherent(AdId);
ALTER TABLE commande ADD CONSTRAINT FK_commande_cote FOREIGN KEY (cote) REFERENCES oeuvre(cote);
ALTER TABLE type_evenement ADD CONSTRAINT FK_type_evenement_id FOREIGN KEY (id) REFERENCES type(id);
ALTER TABLE type_evenement ADD CONSTRAINT FK_type_evenement_NumEv FOREIGN KEY (NumEv) REFERENCES evenement(NumEv);
