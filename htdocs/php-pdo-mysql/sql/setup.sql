--
-- Create the database with a testuser
--
CREATE DATABASE IF NOT EXISTS oophp;
GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";