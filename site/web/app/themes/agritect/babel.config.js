/*
  ===========================================================================
          This is core babel config for app React/Typescript apps.
  ===========================================================================

  - To add some specific presets/plugins to needed environment:

  ...
  const presets = [...]
  const plugins = [...]
  const env = {
    test: {
      plugins: [@babel/plugin-<plugin-name>]
    }
  }
  ...

  ===========================================================================

  - To override some specific presets/plugins:

  ...
  const babelConfig = require('@freshly/frontend-common/config/babel.config')

  module.exports = api => {
    const commonConfig = babelConfig(api)

    return {
      ...commonConfig,
      overrides: [{
        plugins: [...],
        presets: [...],
        env: {...}
      }]
    }
  }
  ...
*/


module.exports = (api, cache = true) => {
  api.cache(cache)

  const presets = [
    '@babel/env',
    '@babel/typescript',
    '@babel/react',
  ]

  const plugins = [
    ['@babel/plugin-proposal-decorators', {
      'legacy': true,
    }],
    ['@babel/plugin-proposal-class-properties', {
      'loose': true,
    }],
    '@babel/plugin-syntax-dynamic-import',
    '@babel/plugin-transform-runtime',
    ['@babel/plugin-transform-regenerator', {
      'async': false,
    }],
  ]

  return {
    presets,
    plugins
  }
}
