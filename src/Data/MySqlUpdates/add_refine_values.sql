BEGIN;

## First Create the new table
CREATE TABLE ore_refine_amounts (
    id INT NOT NULL AUTO_INCREMENT,
    oreTypeId INT NOT NULL,
    mineralTypeId INT NOT NULL,
    quantity INT NOT NULL,
    PRIMARY KEY (id)
);

SET @tritaniumId = 34;
SET @pyriteId = 35;
SET @mexallonId = 36;
SET @isogenId = 37;
SET @nocxiumId = 38;
SET @zydrineId = 39;
SET @megcyteId = 40;
SET @morphiteId = 11399;

SET @PlagioclaseId = 18;
SET @SpodumainId = 19;
SET @KerniteId = 20;
SET @HedbergiteId = 21;
SET @ArkonorId = 22;
SET @BistotId = 1223;
SET @PyroxeresId = 1224;
SET @CrokiteId = 1225;
SET @JaspetId = 1226;
SET @OmberId = 1227;
SET @ScorditeId = 1228;
SET @GneissId = 1229;
SET @VeldsparId = 1230;
SET @HemorphiteId = 1231;
SET @DarkOchreId = 1232;
SET @MercoxitId = 11396;

INSERT INTO ore_refine_amounts (oreTypeId, mineralTypeId, quantity)
    VALUES (@VeldsparId, @tritaniumId, 415),
        (@ScorditeId, @tritaniumId, 346),
        (@ScorditeId, @pyriteId, 173),
        (@PyroxeresId, @tritaniumId, 351),
        (@PyroxeresId, @pyriteId, 25),
        (@PyroxeresId, @mexallonId, 50),
        (@PyroxeresId, @nocxiumId, 5),
        (@PlagioclaseId, @tritaniumId, 107),
        (@PlagioclaseId, @ScorditeId, 213),
        (@PlagioclaseId, @mexallonId, 107),
        (@OmberId, @tritaniumId, 800),
        (@OmberId, @pyriteId, 100),
        (@OmberId, @isogenId, 85),
        (@KerniteId, @tritaniumId, 134),
        (@KerniteId, @mexallonId, 267),
        (@KerniteId, @isogenId, 134),
        (@JaspetId, @mexallonId, 450),
        (@JaspetId, @nocxiumId, 75),
        (@JaspetId, @zydrineId, 8),
        (@HemorphiteId, @tritaniumId, 2200),
        (@HemorphiteId, @isogenId, 100),
        (@HemorphiteId, @nocxiumId, 120),
        (@HemorphiteId, @zydrineId, 15),
        (@HedbergiteId, @pyriteId, 1000),
        (@HedbergiteId, @isogenId, 200),
        (@HedbergiteId, @nocxiumId, 100),
        (@HedbergiteId, @zydrineId, 19),
        (@GneissId, @pyriteId, 2200),
        (@GneissId, @mexallonId, 2400),
        (@GneissId, @isogenId, 300),
        (@DarkOchreId, @tritaniumId, 10000),
        (@DarkOchreId, @isogenId, 1600),
        (@DarkOchreId, @nocxiumId, 120),
        (@CrokiteId, @tritaniumId, 21000),
        (@CrokiteId, @nocxiumId, 760),
        (@CrokiteId, @zydrineId, 135),
        (@BistotId, @pyriteId, 12000),
        (@BistotId, @zydrineId, 450),
        (@BistotId, @megcyteId, 100),
        (@ArkonorId, @tritaniumId, 2200),
        (@ArkonorId, @mexallonId, 2500),
        (@ArkonorId, @megcyteId, 320),
        (@SpodumainId, @tritaniumId, 56000),
        (@SpodumainId, @pyriteId, 12050),
        (@SpodumainId, @megcyteId, 2100),
        (@SpodumainId, @isogenId, 450),
        (@MercoxitId, @morphiteId, 300);

COMMIT;