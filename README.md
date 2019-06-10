# micro-rbac-repo

## 安装

```shell
composer update
```

## 初始化

```shell
php index.php make migration
```

```shell
php index.php make superuser
```

```shell
php index.php make server
```

## 措辞

### Controler

- index_get GET 请求资源集合

- index_get($id) 查询指定资源

- index_post 创建资源

- index_put 更新资源

- index_delete 删除资源

### Model

- all() 查询全部资源列表, 常用于下拉框、级联框等组件数据源

- listByPage() 分页查询资源列表, 常用于列表视图

- show() 查询指定资源

- create() 创建资源

- update() 更新资源

- delete() 删除资源