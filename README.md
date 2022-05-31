# Provisioning Garbage Collection

Calls Garbage Collection for Provisioning Management API with these parameters

- `type=sandbox&days=14`
- `type=transformations&days=7`
- `type=rstudio&hours=120`
- `type=jupyter&hours=120`

## Configuration

Configuration requires Storage API Manage Super User token or Application token with `provisioning:write` scope.

Parameter `kubernetes` with non-empty value runs garbage collection on kubernetes backend instead of docker.

### Example

```
{
    "#X-KBC-ManageApiToken": "TOKEN",
    "syrupURL": "https://syrup.keboola.com"
}
```

## Development

```
docker build . -t provisioning-garbage-collection
docker run --rm --volume $(pwd):/code provisioning-garbage-collection composer install
docker run --rm --volume $(pwd):/code --volume $(pwd)/data:/data provisioning-garbage-collection

```

## License

MIT licensed, see [LICENSE](./LICENSE) file.
