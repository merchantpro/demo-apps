# MerchantPro Demo Apps

This repository showcases the endpoints required for two demo third-party applications for the MerchantPro App Store. The repository contains two separate demo applications: `test_pay` and `hello_world`.

## Repository Structure

The repository is structured as follows:

```bash
.
├── hello_world
│   ├── callback.php
│   ├── install.php
└── test_pay
    ├── callback.php
    ├── install.php
    ├── pay.php
```

### `hello_world`

This directory contains the files for the `hello_world` application.

- **callback.php**: Handles webhook callbacks by validating the HMAC signature and processing the webhook data.
- **install.php**: Manages the installation process by exchanging a code for API credentials.

### `test_pay`

This directory contains the files for the `test_pay` application.

- **callback.php**: Handles webhook callbacks by validating the HMAC signature and processing the webhook data.
- **install.php**: Manages the installation process by exchanging a code for API credentials.
- **pay.php**: Placeholder for payment processing logic.


## License

This repository is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

---

These demo applications are designed to help developers understand how to integrate with the MerchantPro App Store by providing example endpoints for handling webhooks and managing app installations.
