import { DefaultApi, Configuration } from './api-client';

const ApiConfig = new DefaultApi(
  new Configuration({
    basePath: "http://localhost:8000" || DefaultApiConfig.basePath,
  })
);

export { ApiConfig };