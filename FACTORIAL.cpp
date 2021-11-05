#include<iostream>
using namespace std;
int main(){
	
	int factorial(int);
	
	int main(){
		int n;
		cout<<"ingrese un numero"<<endl;
		cin>>n;
		cout<<"factorial de"<<n<<":"<<factorial(n);
		return 0;
	}
	
	int factorial(int i){
		if(n==0)
			return 1;
		
		else
			return n*factorial(n-1);
		
	}
}
