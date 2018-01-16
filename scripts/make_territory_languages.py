import xml.etree.ElementTree as etree
import urllib
import json

ISO = "territory_languages"
FILE_NAME = "../databases/iso_{}.json".format(ISO)

def parse_languages(xml):
    languages = {}
    for t in xml.find('territoryInfo').findall('territory'):
        langs = {}
        for l in t.findall('languagePopulation'):
            langs[l.get('type')] = {
                'percent': float(l.get('populationPercent')),
                'official': bool(l.get('officialStatus'))
            }
        langs = [dict(lang=k, **langs[k]) for k in sorted(langs.keys())]
        languages[t.get('type')] = sorted(langs, key=lambda x: x['percent'], reverse=True)
    return languages

if __name__ == "__main__":
    data = urllib.urlopen('http://unicode.org/repos/cldr/trunk/common/supplemental/supplementalData.xml').read()
    xml = etree.XML(data)
    with open(FILE_NAME, "w") as f:
        f.write(json.dumps({
            ISO: [{'alpha_2':k, 'languages':v} for k,v in parse_languages(xml).items()]
        }, sort_keys=True, indent=2))
