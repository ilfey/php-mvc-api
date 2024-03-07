# Docker compose lamp

## How to add virtual host?

1. Create new conf `sites-available/<domain-name>.conf`
2. Activate site in `entrypoint.sh` using `a2ensite <domain-name>.conf`
3. Forward port in `compose.yml`
