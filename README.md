# Merchant Pro App Store Demo Apps

This repository showcases the endpoints required for two demo third-party applications for the Merchant Pro App Store. The repository contains two separate demo applications: `demo-pay` and `hello-world`.

## Repository Structure

The repository is structured as follows:

```bash
.
├── hello-world
│   ├── callback.php
│   ├── install.php
└── demo-pay
    ├── callback.php
    ├── install.php
    ├── pay.php
```

The `hello-world` directory contains the code for the hello-world demo application, while the `demo-pay` directory contains the code for the demo-pay application.


### `hello-world`

This directory contains the files for the `hello-world` application.

- **callback.php**: Handles webhook callbacks by validating the HMAC signature and processing the webhook data.
- **install.php**: Manages the installation process by exchanging a code for API credentials.

### `demo-pay`

This directory contains the files for the `demo-pay` application.

- **callback.php**: Handles webhook callbacks by validating the HMAC signature and processing the webhook data.
- **install.php**: Manages the installation process by exchanging a code for API credentials.
- **pay.php**: Placeholder for payment processing logic.


## License

This repository is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

---

These demo applications are designed to help developers understand how to integrate with the Merchant Pro App Store by providing example endpoints for handling webhooks and managing app installations.
