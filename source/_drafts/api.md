## 网址安全
- https://bsb.baidu.com/diagnosis
- https://www.showapi.com/apiGateway/onlineTest?apiCode=1509&pointCode=1

## IP地理位置
- http://ip.taobao.com/service/getIpInfo.php?ip= 不支持https 卡慢
- https://whois.pconline.com.cn/ipJson.jsp?ip=${ip}&json=true 已备案不含经纬度
- https://pv.sohu.com/cityjson?ie=utf-8 (Content-Type: text/json; charset=gbk) 只有当前ip
- https://ip.ws.126.net/ipquery?ip= 只有省市
- http://api.ipaddress.com/myip 只有当前ip 不支持https
- http://api.ipaddress.com/iptocountry?format=json&ip=171.124.38.173 免费仅国家不含经纬度 具体位置付费
- https://www.iplocate.io/api/lookup/${ip} 未备案 英文  位置不明确但含经纬度 不准确 国内固定为"latitude":34.7725,"longitude":113.7266
- http://ip-api.com/json/${ip}?lang=zh-CN 未备案　支持语言　位置不准确含经纬度 https付费
- http://api.ipstack.com/18.177.149.102?access_key= https isp付费 不准确
- http://api.k780.com:88/?app=ip.get&ip=112.74.41.209&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json 不支持https 不含经纬度
- https://apidata.chinaz.com/CallAPI/ip?ip=${ip}&key=${key} 付费 免费额度100
- https://api.ip138.com/query/?ip=${ip}&token=${token} 付费 免费额度1000 与在线版内容不一致
- https://www.ipaddressapi.com/  https://ipgeolocationapi.org/ 三天免费试用
- http://apis.juhe.cn/ip/ipNew?ip=112.112.11.11&key= 每天限100 不含经纬度

## latex服务端渲染接口
- https://cdn.nlark.com/yuque/__latex
- https://math.jianshu.com/math?formula=
- http://latex.codecogs.com/gif.latex