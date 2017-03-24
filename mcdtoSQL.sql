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
        TypeOeuvre    Varchar (25) ,
        PrixAchat     DECIMAL (15,3)  ,
        DomOeuvre     Varchar (25) ,
        IdAuteur      Int NOT NULL ,
        PRIMARY KEY (cote )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: mot_clefs
#------------------------------------------------------------

CREATE TABLE mot_clefs(
        nom    Varchar (25) NOT NULL ,
        id_Mot int (11) Auto_increment  NOT NULL ,
        PRIMARY KEY (id_Mot )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: exemplaire
#------------------------------------------------------------

CREATE TABLE exemplaire(
        NumExmp      int (11) Auto_increment  NOT NULL ,
        cote         Int NOT NULL ,
        Prolongement Bool NOT NULL ,
        EtatExmp     Bool ,
        cote_oeuvre  Int ,
        IdEdit       Int NOT NULL ,
        IdRa         Int NOT NULL ,
        PRIMARY KEY (NumExmp )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Auteur
#------------------------------------------------------------

CREATE TABLE Auteur(
        nom        Varchar (25) NOT NULL ,
        prenom     Varchar (25) NOT NULL ,
        NaisAuteur Date NOT NULL ,
        IdAuteur   int (11) Auto_increment  NOT NULL ,
        PRIMARY KEY (IdAuteur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: evenement
#------------------------------------------------------------

CREATE TABLE evenement(
        NumEv      int (11) Auto_increment  NOT NULL ,
        DateEv     Date NOT NULL ,
        LieuEv     Varchar (25) NOT NULL ,
        CapaciteEv Int NOT NULL ,
        PRIMARY KEY (NumEv )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: adhérent
#------------------------------------------------------------

CREATE TABLE adherent(
        IdAdherent  int (11) Auto_increment  NOT NULL ,
        AdNom       Varchar (25) NOT NULL ,
        AdAdresse   Varchar (25) ,
        AdAdhesion  Date NOT NULL ,
        AdNaissance Date ,
        AdTel       Int NOT NULL ,
        AdMail      Varchar (25) NOT NULL ,
        AdPaiement  Date NOT NULL ,
        PRIMARY KEY (IdAdherent )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: editeur
#------------------------------------------------------------

CREATE TABLE editeur(
        IdEdit  int (11) Auto_increment  NOT NULL ,
        NomEdit Varchar (25) NOT NULL ,
        PRIMARY KEY (IdEdit )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: rayon
#------------------------------------------------------------

CREATE TABLE rayon(
        IdRa      int (11) Auto_increment  NOT NULL ,
        domaineRa Varchar (25) NOT NULL ,
        PRIMARY KEY (IdRa )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: conference
#------------------------------------------------------------

CREATE TABLE conference(
        nom          Varchar (25) ,
        conferencier Varchar (25) ,
        description  Varchar (25) ,
        NumEv        Int NOT NULL ,
        PRIMARY KEY (NumEv )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: projection
#------------------------------------------------------------

CREATE TABLE projection(
        nom         Varchar (25) ,
        cote        Int NOT NULL ,
        description Varchar (25) ,
        NumEv       Int NOT NULL ,
        PRIMARY KEY (NumEv )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: exposition
#------------------------------------------------------------

CREATE TABLE exposition(
        nom         Varchar (25) ,
        description Varchar (25) ,
        NumEv       Int NOT NULL ,
        PRIMARY KEY (NumEv )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: spectacle
#------------------------------------------------------------

CREATE TABLE spectacle(
        nom         Varchar (25) ,
        description Varchar (25) ,
        NumEv       Int NOT NULL ,
        PRIMARY KEY (NumEv )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: theme
#------------------------------------------------------------

CREATE TABLE theme(
        nom      Varchar (25) NOT NULL ,
        id_Theme int (11) Auto_increment  NOT NULL ,
        PRIMARY KEY (id_Theme )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: appartient
#------------------------------------------------------------

CREATE TABLE appartient(
        cote   Int NOT NULL ,
        id_Mot Int NOT NULL ,
        PRIMARY KEY (cote ,id_Mot )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: participe
#------------------------------------------------------------

CREATE TABLE participe(
        IdAdherent Int NOT NULL ,
        NumEv      Int NOT NULL ,
        PRIMARY KEY (IdAdherent ,NumEv )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reserve
#------------------------------------------------------------

CREATE TABLE reserve(
        DateReservation Date ,
        cote            Int NOT NULL ,
        IdAdherent      Int NOT NULL ,
        PRIMARY KEY (cote ,IdAdherent )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commande
#------------------------------------------------------------

CREATE TABLE commande(
        dateCommande Date ,
        Commentaire  Varchar NOT NULL ,
        IdAdherent   Int NOT NULL ,
        cote         Int NOT NULL ,
        PRIMARY KEY (IdAdherent ,cote )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: est_projeter
#------------------------------------------------------------

CREATE TABLE est_projeter(
        NumEv Int NOT NULL ,
        cote  Int NOT NULL ,
        PRIMARY KEY (NumEv ,cote )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: appartient_theme
#------------------------------------------------------------

CREATE TABLE appartient_theme(
        NumEv    Int NOT NULL ,
        id_Theme Int NOT NULL ,
        PRIMARY KEY (NumEv ,id_Theme )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: emprunt
#------------------------------------------------------------

CREATE TABLE emprunt(
        dateEmprunt Date NOT NULL ,
        NumExmp     Int NOT NULL ,
        IdAdherent  Int NOT NULL ,
        PRIMARY KEY (NumExmp ,IdAdherent )
)ENGINE=InnoDB;

ALTER TABLE oeuvre ADD CONSTRAINT FK_oeuvre_IdAuteur FOREIGN KEY (IdAuteur) REFERENCES Auteur(IdAuteur);
ALTER TABLE exemplaire ADD CONSTRAINT FK_exemplaire_cote_oeuvre FOREIGN KEY (cote_oeuvre) REFERENCES oeuvre(cote);
ALTER TABLE exemplaire ADD CONSTRAINT FK_exemplaire_IdEdit FOREIGN KEY (IdEdit) REFERENCES editeur(IdEdit);
ALTER TABLE exemplaire ADD CONSTRAINT FK_exemplaire_IdRa FOREIGN KEY (IdRa) REFERENCES rayon(IdRa);
ALTER TABLE conference ADD CONSTRAINT FK_conference_NumEv FOREIGN KEY (NumEv) REFERENCES evenement(NumEv);
ALTER TABLE projection ADD CONSTRAINT FK_projection_NumEv FOREIGN KEY (NumEv) REFERENCES evenement(NumEv);
ALTER TABLE exposition ADD CONSTRAINT FK_exposition_NumEv FOREIGN KEY (NumEv) REFERENCES evenement(NumEv);
ALTER TABLE spectacle ADD CONSTRAINT FK_spectacle_NumEv FOREIGN KEY (NumEv) REFERENCES evenement(NumEv);
ALTER TABLE appartient ADD CONSTRAINT FK_appartient_cote FOREIGN KEY (cote) REFERENCES oeuvre(cote);
ALTER TABLE appartient ADD CONSTRAINT FK_appartient_id_Mot FOREIGN KEY (id_Mot) REFERENCES mot_clefs(id_Mot);
ALTER TABLE participe ADD CONSTRAINT FK_participe_IdAdherent FOREIGN KEY (IdAdherent) REFERENCES adherent(IdAdherent);
ALTER TABLE participe ADD CONSTRAINT FK_participe_NumEv FOREIGN KEY (NumEv) REFERENCES evenement(NumEv);
ALTER TABLE reserve ADD CONSTRAINT FK_reserve_cote FOREIGN KEY (cote) REFERENCES oeuvre(cote);
ALTER TABLE reserve ADD CONSTRAINT FK_reserve_IdAdherent FOREIGN KEY (IdAdherent) REFERENCES adherent(IdAdherent);
ALTER TABLE commande ADD CONSTRAINT FK_commande_IdAdherent FOREIGN KEY (IdAdherent) REFERENCES adherent(IdAdherent);
ALTER TABLE commande ADD CONSTRAINT FK_commande_cote FOREIGN KEY (cote) REFERENCES oeuvre(cote);
ALTER TABLE est_projeter ADD CONSTRAINT FK_est_projeter_NumEv FOREIGN KEY (NumEv) REFERENCES evenement(NumEv);
ALTER TABLE est_projeter ADD CONSTRAINT FK_est_projeter_cote FOREIGN KEY (cote) REFERENCES oeuvre(cote);
ALTER TABLE appartient_theme ADD CONSTRAINT FK_appartient_theme_NumEv FOREIGN KEY (NumEv) REFERENCES evenement(NumEv);
ALTER TABLE appartient_theme ADD CONSTRAINT FK_appartient_theme_id_Theme FOREIGN KEY (id_Theme) REFERENCES theme(id_Theme);
ALTER TABLE emprunt ADD CONSTRAINT FK_emprunt_NumExmp FOREIGN KEY (NumExmp) REFERENCES exemplaire(NumExmp);
ALTER TABLE emprunt ADD CONSTRAINT FK_emprunt_IdAdherent FOREIGN KEY (IdAdherent) REFERENCES adherent(IdAdherent);
