# logger-design
日志服务设计，支持同时将日志存储到text文本, mysql, redis, mongo, meilisearch里(自由配置，配置文件在config.toml)

## 用法示例
```
$log = Log::new();
$log->info("测试");
```
