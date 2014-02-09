# coding=utf8
#!/usr/bin/env python
############################
# 
#  有道翻译 For Alfredworkflow
#
#  __author__ = '李伟'
############################
import os
import urllib2
import urllib
import json
import sys
from Feedback import Feedback
#中文乱码
reload(sys)
sys.setdefaultencoding( "utf-8" )

# 获取翻译结果
def get_trans_result(keyword):
    # 有道API
    youdao_api = 'http://fanyi.youdao.com/openapi.do?' \
                 'keyfrom=simman' \
                 '&key=902290141' \
                 '&type=data' \
                 '&doctype=json' \
                 '&version=1.1&' + \
                 urllib.urlencode({'q':keyword})

    result_json = urllib2.urlopen(youdao_api)
    base_json = json.load(result_json)

    fb = Feedback()
    # 处理错误信息
    try:
        fb.add_item(base_json['reason'])
    except:
        for dic in base_json['web'] :
            fb.add_item(dic['key'], '，'.join(dic['value']))

    print fb