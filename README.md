# wr602d

Symfony / Gotenberg

## Installation

1. Clone the repository.
    ```bash
    git clone https://github.com/lokinosuke/wr602d.git
    ```

2. Install dependencies.
    ```bash
    composer install
    composer update
    php bin/console tailwind:build
    ```

3. Configure the database connection in the `.env` file.

4. Run database migrations.
    ```bash
    php bin/console doctrine:migrations:migrate
    ```

## Usage

Explain how to use your Symfony project. Provide examples and instructions if necessary.

## Contributing

If you'd like to contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch.
3. Make your changes and commit them.
4. Push your changes to your forked repository.
5. Submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).
