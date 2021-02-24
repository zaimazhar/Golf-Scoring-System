# Smart Golf Scoring Website System ⛳

A platform to enhance quality and productivity of scoring in golf tournaments

## Introduction

Having an official and crucial tournaments require a massive workloads to handle such significant event. Large workloads bring along countless mistakes by different parties especially on administration of the scoreboard. Such mistakes on a big stage with renowned participants and guests will clearly tarnish the tournament's reputation.

## Project Outline
- Secure system implementation using session-based authentication and CSRF protection.
- Multiple layer of authorization to limit users access.
- Efficient data persistent throughout the application ensuring the data is safe in the data vault.
- Frontend of the application is reactive and responsive to the backend of the application. (view-model principle)
- Attractive and interactive user interface and user experience. (Dynamic data resolution)
- Sessions to pass variables content.

## Issues
- Score Relationships (How to Store Score Properly)
  - Refer to ERD

## TO-DOs
- Frontend
  - Login Page (10%)
  - Organizer Dashboard (10%)
  - Admin Dashboard
  - Public View

- Backend
  - Configure server environment
    - Build Tables
      - Users
        - Privilege Users (100%)
      - Players
      - Teams
      - Competition
        - Venue
          - Properties (100%)
          - Par
          - Format
            - Stableford
      - Score
  
  - Build all packages
    - Authentication (100%)
    - Authorization (100%)
    - ~~CSRF (10%)~~ (__Abandoned__)
    - APIs (?)
    - Model Class (75%)
    - ~~Query Builder~~
    - ~~Seeder~~
    - Score Computation

## Stack

- Apache [Web Server]
- HTML5 [Frontend]
- PHP (v7.4.3) [Backend]
- PostgreSQL [Database]

## References

- [PHP](https://www.php.net/)
- [StackOverflow](https://stackoverflow.com/)
- [YouTube](https://www.youtube.com/)
