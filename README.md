# coding和github差异
```yml
# ./_config.yml
url: https://blog.makergyt.com
deploy:
  - type: git
    repo: git@github.com:MakerGYT/makergyt.github.io.git
    branch: master
  - type: git
    repo: git@git.dev.tencent.com:memakergytcom/memakergytcom.git
    branch: master
baidusitemap:
  path: baidusitemap.xml
# next/_config.yml
google_site_verification: XAprdFd37bx8X8i-_S77-8ArPy8hkI5RCtKym1Z52rY
bing_site_verification: E14AC9D3BA8CE3C20D05F77EE7BC738F
baidu_site_verification: X1fnAis2FT
gitalk:
  enable: true
  github_id: makergyt # Github repo owner
  repo: makergyt.github.io # Repository name to store issues
  client_id: 64a9c28ff540acfb8d4b
  # Github Application Client ID
  client_secret: 647cb5af47a926a76f6eb1d1001fe8a5230dd0b0 # Github Application Client Secret
  admin_user: makergyt # GitHub repo owner and collaborators, only these guys can initialize github issues
  distraction_free_mode: true # Facebook-like distraction free mode
  # Gitalk's display language depends on user's browser or system environment
  # If you want everyone visiting your site to see a uniform language, you can set a force language value
  # Available values: en, es-ES, fr, ru, zh-CN, zh-TW
  language:
```