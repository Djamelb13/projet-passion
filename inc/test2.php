

<?php $sql = " BEGIN


UPDATE console
SET game_title = 'Nouveau nom du jeu'
WHERE game_title = 'AMAZING GAME';

// -- Modifier la colonne game_title dans la table jeu
UPDATE jeu
SET game_title = 'Nouveau nom du jeu'
WHERE game_title = 'AMAZING GAME';

// -- Modifier la colonne game_title dans la table physique
UPDATE physique
SET game_title = 'Nouveau nom du jeu'
WHERE game_title = 'AMAZING GAME';

// -- Modifier la colonne game_title dans la table virtuel
UPDATE virtuel
SET game_title = 'Nouveau nom du jeu'
WHERE game_title = 'AMAZING GAME';

COMMIT; " ?>

START TRANSACTION;
-- Modifier la colonne game_title dans la table jeu
UPDATE jeu
SET game_title = 'Nouveau nom du jeu'
WHERE game_title = 'AMAZING GAME';

-- Modifier les enregistrements dans la table compose
UPDATE compose
SET game_title = 'Nouveau nom du jeu'
WHERE game_title = 'AMAZING GAME';

-- Modifier la colonne game_title dans la table virtuel
UPDATE propose_une_vente
SET game_title = 'Nouveau nom du jeu'
WHERE game_title = 'AMAZING GAME';

-- Modifier la colonne game_title dans la table console
UPDATE console
SET game_title = 'Nouveau nom du jeu'
WHERE game_title = 'AMAZING GAME';

-- Modifier la colonne game_title dans la table physique
UPDATE physique
SET game_title = 'Nouveau nom du jeu'
WHERE game_title = 'AMAZING GAME';

-- Modifier la colonne game_title dans la table virtuel
UPDATE virtuel
SET game_title = 'Nouveau nom du jeu'
WHERE game_title = 'AMAZING GAME';



COMMIT;
