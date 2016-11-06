#include <iostream>

int main(int argc,char* argv[]) {
	std::string input;
	while(getline(std::cin,input))
		std::cout << input.erase(0,9) << std::endl;
	return 0;
}
