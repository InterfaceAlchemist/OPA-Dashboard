// Turns the PHP page into plain static HTML so it can be hosted without a PHP server (e.g. on Vercel).
// index.php only stitches HTML pieces together with `include`, so this script does the same thing.
// Run:  node build-static.mjs   →  writes dist/index.html
import { copyFileSync, mkdirSync, readFileSync, rmSync, writeFileSync } from 'node:fs'
import { join } from 'node:path'

const root = process.cwd()
const INCLUDE = /<\?php\s+(?:include|require)(?:_once)?\s+['"]([^'"]+)['"]\s*;?\s*\?>/g

const render = (file) =>
  readFileSync(join(root, file), 'utf8')
    .replace(/^\uFEFF/, '') // strip a UTF-8 byte-order mark if an editor added one
    .replace(INCLUDE, (_, path) => render(path))

const html = render('index.php')

// Fail the build loudly if any real PHP is left — static hosting would show it as broken text
if (/<\?(php|=)/i.test(html)) {
  console.error('Build stopped: index.php or an included file contains PHP code that cannot be exported.')
  process.exit(1)
}

rmSync(join(root, 'dist'), { recursive: true, force: true })
mkdirSync(join(root, 'dist'), { recursive: true })
writeFileSync(join(root, 'dist', 'index.html'), html)
copyFileSync(join(root, 'opa-logo.ico'), join(root, 'dist', 'opa-logo.ico'))
console.log(`Built dist/index.html (${(html.length / 1024).toFixed(0)} KB)`)