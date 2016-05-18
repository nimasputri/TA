f = open('tweets.dat')
lines = f.read().split('\n')
berkas = open('opinion.dat', 'w')
for index, line in enumerate(lines):
    if line[-1] == '0':
        berkas.write(line)
        berkas.write('\n')
    else:
        berkas.write(line[:-2])
        berkas.write(':1')
        berkas.write('\n')
f.close()
berkas.close()
