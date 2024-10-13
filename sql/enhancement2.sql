-- INSERT
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment) VALUES ("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", "I am the real Ironman")

-- UPDATE
UPDATE clients SET clientLevel = "3" WHERE clientId = "126"

-- UPDATE WITH REPLACE FUNCTION
UPDATE inventory SET invDescription = REPLACE(invDescription, "small interior", "spacious interior") WHERE invMake = "GM" AND invModel = "Hummer"

-- INNER JOIN
SELECT inventory.invModel, carclassification.classificationName
FROM carclassification
INNER JOIN inventory ON carclassification.classificationId = inventory.classificationId
WHERE carclassification.classificationName = "SUV"

-- DELETE
DELETE
FROM inventory
WHERE invMake = "Jeep" and invModel = "Wrangler"

-- UPDATE & CONCAT
UPDATE inventory
SET invImage = concat("/phpmotors", invImage), invThumbnail = concat("/phpmotors", invThumbnail)