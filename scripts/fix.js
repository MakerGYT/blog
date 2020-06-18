hexo.extend.filter.register('after_post_render', function(data){
  let footnoteBlockOpen = `<hr class="footnotes-sep">`;
  let replaceBlockOpen = `<h2 id="-参考文献" class="footnotes-meta ${data.language}">${data.language == 'en'?'REFERENCES': '参 考 文 献' }</h2>`;
  data.content = data.content.replace(footnoteBlockOpen, footnoteBlockOpen+replaceBlockOpen);
  return data;
});
hexo.extend.filter.register('after_render:html', function(str, data){
  let tocLink = `<a class="nav-link" href="#">`;
  let replaceLink = `<a class="nav-link" href="#-参考文献">`;
  str = str.replace(tocLink, replaceLink);
  // fix wechat browser
  str = str.replace(/<link rel="stylesheet" href="([^"]+)\/css\?family=([^<]+)"*>/,(match,fontHost,family) =>{
    let config = hexo.theme.config.font;

    if (!config || !config.enable || !fontHost || !family) return match;
  
    let fontDisplay = '&display=swap';
    let fontSubset = '&subset=latin,latin-ext';
    let fontStyles = ':wght@400;500;700';
  
    //Get a font list from config
    let fontFamilies = ['global', 'title', 'headings', 'codes'].map(item => {
      if (config[item] && config[item].family && config[item].external) {
        return config[item].family + fontStyles;
      }
      return '';
    });
  
    fontFamilies = fontFamilies.filter(item => item !== '');
    fontFamilies = [...new Set(fontFamilies)];
    fontFamilies = fontFamilies.join('&family');
    // Merge extra parameters to the final processed font string
    return fontFamilies ? 
      `<link rel="stylesheet" href="${fontHost}/css2?family=${fontFamilies.concat(fontDisplay, fontSubset)}">
      <link rel="stylesheet" href="${fontHost}/css2?family=${config['posts'].family}${fontStyles}${fontDisplay}${fontSubset}">` : '';
  })
  return str;
});