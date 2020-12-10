CREATE TABLE competition (
    id BIGSERIAL NOT NULL PRIMARY KEY,
    venue_name VARCHAR(50) NOT NULL,
    date_of_event DATE NOT NULL,
    country VARCHAR(50) NOT NULL
);

INSERT INTO competition (venue_name, date_of_event, country) VALUES ('UniMAP Sport Recreation', NOW(), 'Malaysia');