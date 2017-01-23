# Provisioning Garbage Collection

Calls Garbage Collection for Provisioning Management API with these parameters

- `type=sandbox&days=7`
- `type=transformations&days=7`

Next steps are

- `type=rstudio&hours=120`
- `type=jupyter&hours=120`

## Configuration 

Configuration requires Storage API Manage Super User token or Application token with `provisioning:write` scope.

### Example

```
{
    "#X-KBC-ManageApiToken": "TOKEN"
}
```
