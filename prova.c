#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <string.h>

int main(){
    srand(time(NULL));
    int r = rand()%100 + 1;
    printf("%d", r);
    return 0;
}