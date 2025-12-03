CREATE TABLE ENTRAINEUR (
    idEntraineur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARBINARY(512),
    prenom VARBINARY(512),
    role VARBINARY(512),
    login VARBINARY(512),
    mot_de_passe VARBINARY(512)
);

CREATE TABLE ENTRAINEMENT (
    idEntrainement INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255),
    dateCreation DATETIME,
    idEntraineur INT NOT NULL,
    FOREIGN KEY (idEntraineur) REFERENCES ENTRAINEUR(idEntraineur)
);

CREATE TABLE SEANCE (
    idSeance INT PRIMARY KEY AUTO_INCREMENT,
    dateSeance DATE,
    heureDebut TIME,
    heureFin TIME,
    idEntrainement INT NOT NULL,
    FOREIGN KEY (idEntrainement) REFERENCES ENTRAINEMENT(idEntrainement)
);

CREATE TABLE COMMENTAIRE (
    idCommentaire INT PRIMARY KEY AUTO_INCREMENT,
    texte VARCHAR(255),
    dateCommentaire DATETIME,
    idEntraineur INT NOT NULL,
    idSeance INT NOT NULL,
    FOREIGN KEY (idEntraineur) REFERENCES ENTRAINEUR(idEntraineur),
    FOREIGN KEY (idSeance) REFERENCES SEANCE(idSeance)
);

CREATE TABLE ADHERENT (
    idAdherent INT PRIMARY KEY AUTO_INCREMENT,
    nom VARBINARY(512),
    prenom VARBINARY(512),
    profession VARBINARY(512),
    mail VARBINARY(512),
    telephone VARBINARY(512),
    adresse VARBINARY(512),
    login VARBINARY(512),
    mot_de_passe VARBINARY(512)
);

CREATE TABLE ENTRAINER (
    idEntraineur INT,
    idEntrainement INT,
    idJour INT,
    PRIMARY KEY (idEntraineur, idEntrainement, idJour),
    FOREIGN KEY (idEntraineur) REFERENCES ENTRAINEUR(idEntraineur),
    FOREIGN KEY (idEntrainement) REFERENCES ENTRAINEMENT(idEntrainement)
);

CREATE TABLE AUDIT_LOG (
    idLog INT PRIMARY KEY AUTO_INCREMENT,
    action VARCHAR(255),
    ip VARCHAR(50),
    date DATETIME,
    idEntraineur INT NOT NULL,
    FOREIGN KEY (idEntraineur) REFERENCES ENTRAINEUR(idEntraineur)
);

CREATE TABLE ECHANGER (
    identraineurDemandant INT,
    identraineurRemplaçant INT,
    idSeance INT,
    statut NVARCHAR(50),
    commentaire VARCHAR(255),
    dateEchange DATETIME,
    PRIMARY KEY (identraineurDemandant, identraineurRemplaçant, idSeance),
    FOREIGN KEY (identraineurDemandant) REFERENCES ENTRAINEUR(idEntraineur),
    FOREIGN KEY (identraineurRemplaçant) REFERENCES ENTRAINEUR(idEntraineur),
    FOREIGN KEY (idSeance) REFERENCES SEANCE(idSeance)
);
