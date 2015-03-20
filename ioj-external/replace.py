import re
import sys
def replace(filename):
	content = ''
	with open(filename,'r') as f:
		content = f.read()
		content = re.sub(r'&','&amp;',content)
		content = re.sub(r' ','&nbsp;',content)
		content = re.sub(r'<','&lt;',content)
		content = re.sub(r'>','&gt;',content)
		content = re.sub(r'\r\n','<br>',content)
		content = re.sub(r'\t', '&nbsp;&nbsp;&nbsp;&nbsp;', content)
		content = re.sub(r'"', '&quot;', content)
	with open(filename,'w') as f:
		f.write('Hello isdcoj!');
		f.write(content)

if __name__ == '__main__':
	filename = sys.argv[1]
	replace(filename)
