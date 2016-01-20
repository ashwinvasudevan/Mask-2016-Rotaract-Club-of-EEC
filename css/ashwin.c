/*
* The code is released under the GNU General Public License.
* Developed by Mark Williams
* A guide to this code can be found here; http://ozzmaker.com/2013/04/22/845/
* Created 28th April 2013
*/

#include "i2c-dev.h"
#include "adxl345.h"
#include "stdint.h"
#include<stdio.h>
#include <fcntl.h>

//#include "gyro.h"
int file;
#define ACC_ADDRESS 0x53

#include <unistd.h>
#include <math.h>
#include <signal.h>
#include <errno.h>
#include <stdio.h>
#include <stdlib.h>
#include <fcntl.h>
#include <string.h>
#include <time.h>
#include "adxl345.h"
#include "i2c-dev.h"

float global;

void  readBlock(uint8_t command, uint8_t size, uint8_t *data)
{
    int result = i2c_smbus_read_i2c_block_data(file, command, size, data);
    if (result != size)
    {
        printf("Failed to read block from I2C.");
        exit(1);
    }
}

void selectDevice(int file, int addr)
{
        char device[3];


        if (ioctl(file, I2C_SLAVE, addr) < 0) {
                fprintf(stderr,
                        "Error: Could not select device  0x%02x: %s\n",
                        device, strerror(errno));
        }
}
void readACC(int  *a)
{
 	uint8_t block[6];
 	 selectDevice(file,ACC_ADDRESS);
	readBlock(0x80 | DATAX0, sizeof(block), block);

	*a = (int16_t)(block[0] | block[1] << 8) >> 4;
	global = *a;
	*(a+1) = (int16_t)(block[2] | block[3] << 8) >> 4;
	*(a+2) = (int16_t)(block[4] | block[5] << 8) >> 4;
}

void enableIMU()
{

	__u16 block[I2C_SMBUS_BLOCK_MAX];

        int res, bus,  size;


        char filename[20];
        sprintf(filename, "/dev/i2c-%d", 1);
        file = open(filename, O_RDWR);
        if (file<0) {
		printf("Unable to open I2C bus!");
                exit(1);
        }


}


int main(int argc, char *argv[])
{




	int  *Pacc_raw;
	int  acc_raw[3];
	float final;


	Pacc_raw = acc_raw;
	enableIMU();





	while(1)
	{



	//read ACC and GYR data
	//readMAG(Pmag_raw);
	readACC(Pacc_raw);
	final = (float) *Pacc_raw;
	//readGYR(Pgyr_raw);

	printf("raw acceleration %f",global);
	}
	return 0;
}

