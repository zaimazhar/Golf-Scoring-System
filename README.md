# Smart Golf Scoring Website System ⛳ (Completed)

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
  - Refer to ERD (Solution: Add both Stroke and Stableford scores to avoid double tables inclusion)

## TO-DOs
- Frontend
  - Login Page (100%)
  - Organizer Dashboard (100%)
  - Admin Dashboard (100%)
  - Public View (100%)

- Backend
  - Configure server environment
    - Build Tables
      - Users
        - Privilege Users (100%)
      - Participants (Player & Team) (100%)
      - Competition (100%)
        - Venue (100%)
          - Properties (100%)
          - Par (100%)
          - Format (100%)
            - Stableford (100%)
      - Score
  
  - Build all packages
    - Authentication (100%)
    - Authorization (100%)
    - Model Class (100%)
    - ~~Query Builder~~
    - ~~Seeder~~
    - Score Computation (Include 'Stableford' into 'score' table)

## Stack

- Apache [Web Server]
- HTML5 [Frontend]
- PHP (v7.4.3) [Backend]
- PostgreSQL [Database]

## References

- [PHP](https://www.php.net/)
- [StackOverflow](https://stackoverflow.com/)
- [YouTube](https://www.youtube.com/)
