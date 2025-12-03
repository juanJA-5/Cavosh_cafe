import config
import inspect
import os

print("CONFIG IMPORTADO DESDE:")
print(os.path.abspath(inspect.getfile(config)))

print("\nATRIBUTOS DEL CONFIG:")
print(dir(config))
