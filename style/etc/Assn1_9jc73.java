/*	
 * Name: Emma Chen 
 * NETID:9JC73
 * SN: 06281339
 * Assignment 1: Model Fish Farm	
 */
import java.util.Scanner;
import java.util.InputMismatchException;

public class Assn1_9jc73 {

	public final static double TGC 			= 0.191; //TGC for rainbow trout
	public final static double MORTALITY 	= 0.00022; //MORTALITY rate per day
	public final static double FOODENERGY 	= 18.5; //KJ per fish
	public final static Scanner input 		= new Scanner(System.in);

	public static void main(String[] args) {
		double[][] inputData;
		double[][] calculatedData;

		//prompt the user to enter the initial number of fish and initial weight of fish
		int iNumber = getInitialAmount();
		double iWeight = getInitialWeight();

		//get how many intervals there are
		int totalIntervals = getIntervals();

		//prompt the user to input the interval days and temperature for each interval
		//return the input in an array in form of [[days1, temperature1], [days2, temperature2]...]
		inputData = getInput(totalIntervals);

		//return a 2D array of the calculated data 
		//with the format[[interval,  ]]
		calculatedData = calculateData(inputData, iNumber, iWeight);

		//display the data and calculated values in tabular form
		displayData(calculatedData, iNumber, iWeight);
	}

	//get the schedule from user in the form of an array
	private static double[][] getInput(int totalIntervals) {
		double[][] inputData = new double[totalIntervals][2];

		for (int i=0; i<totalIntervals; i++) {
			inputData[i][0] = getIntervalDays(i);
			inputData[i][1] = getIntervalTemp(i);
		}

		return inputData;
	}

	//calculate the number, weight, and feedconsumed after each interval
	private static double[][] calculateData(double[][] data, int number, double weight) {
		double[][] result = new double[data.length][6];
		double optimalWeight;
		double feedConsumed;

		for (int i=0; i<data.length; i++) {
			optimalWeight = getOptimalWeight(weight, data[i][0], data[i][1]);
			feedConsumed =  getTE(weight, optimalWeight, data[i][0], data[i][1])/FOODENERGY * number / 1000;
			weight = optimalWeight;
			number = (int)(number*Math.pow(1-MORTALITY, data[i][0])); //original * survival^days

			result[i][0] = i+1; //interval #
			result[i][1] = data[i][0]; //# of days
			result[i][2] = data[i][1]; //temperature
			result[i][3] = number; //fish number at end of interval
			result[i][4] = weight; //weight (g/fish) at end of interval
			result[i][5] = feedConsumed; //feed consumed(kg) for interval
		}

		return result;
	}

	//displays the data in a tabular form
	private static void displayData(double[][] calculatedData, int number, double weight) {
		double totalFeed = 0;
		double gainToFeed;
		double iWeight = weight;
		double fWeight;
		int iNumber = number;
		int fNumber;

		System.out.printf("%10s %10s %15s %10s %10s %15s%n", "Interval#", "Days", "Temperature", "Fish#", "Weight", "Feed Consumed");
		System.out.printf("%10s %10s %15s %10s %10s %15s%n", "", "", "(deg C)", "", "(g/fish)", "(kg)");
		System.out.println(String.format("%085d", 0).replace("0", "-"));
		for (int i=0; i<calculatedData.length; i++) {
			System.out.printf("%10d %10d %15.1f %10d %10.2f %15.2f%n", (int)calculatedData[i][0], 
					(int)calculatedData[i][1],
					calculatedData[i][2],
					(int)calculatedData[i][3],
					calculatedData[i][4],
					calculatedData[i][5]);
			totalFeed += calculatedData[i][5];
		}
		fNumber = (int)calculatedData[calculatedData.length-1][3];
		fWeight = calculatedData[calculatedData.length-1][4];
		totalFeed = getTotalFeed(calculatedData);
		gainToFeed = getGainToFeed(iNumber,fNumber, iWeight, fWeight, totalFeed);
		System.out.println(String.format("%085d", 0).replace("0", "-"));
		System.out.printf("Total feed consumed: %.2fkg%n", totalFeed);
		System.out.printf("Gain to feed ratio: %.2f%n", gainToFeed);
	}

	//calculate optimal fish weight, returns double
	private static double getOptimalWeight(double iWeight, double day, double temperature) {
		double weight = 0;

		weight = Math.pow(iWeight, 1.0/3) + (TGC * day * temperature)/100;
		weight = Math.pow(weight, 3);

		return weight; //returns optimal weight in g/fish
	}

	//calculate total energy needed per fish
	public static double getTE(double pWeight, double weight, double days, double temperature) {
		double ME = 0;
		ME = (-0.0104 + 3.26*temperature - 0.05*Math.pow(temperature, 2)) * Math.pow(weight/1000, 0.824) * days;
		//ME formula

		double RE = 0;
		RE = (5.0 + 0.005*weight) * (weight - pWeight);
		//RE formula

		double DE = (ME + RE) * 0.2;
		//DE formula

		double EL = (ME + RE + DE) * 0.1;
		//EL formula

		double TE;
		TE = ME + RE + DE + EL;
		//TE formula

		return TE;
	}

	//calculate the total feed in kg
	private static double getTotalFeed(double[][] calculatedData) {
		double totalFeed = 0;
		for (int i=0; i<calculatedData.length; i++) {
			totalFeed += calculatedData[i][5];
		}
		return totalFeed;
	}

	//calculate gain to feed ratio
	public static double getGainToFeed(int iNumber, int fNumber, double iWeight, double fWeight, double totalFeed) {

		return (fNumber*fWeight - iNumber*iWeight)/totalFeed/1000;
	}

	//get total number of intervals
	private static int getIntervals() {
		String dump = "";
		boolean inputOK = false;
		int total = 0;

		System.out.print("Please enter the total number of intervals you wish to enter: ");
		do{
			try {
				total = input.nextInt();
				if (total <=0 ) {
					System.out.printf("%d is not in the valid range, please enter a number greater than 0: ", total);
				} else {
					inputOK = true;
				}
			} catch(InputMismatchException e) {
				dump = input.nextLine();
				System.out.printf("\"%s\" is not a valid integer, please try again: ", dump);
			}

		} while(inputOK!=true);

		return total;	
	}

	//get initial fish number, returns integer
	private static int getInitialAmount() {
		String dump = "";
		boolean inputOK = false;
		int iNumber = 0;

		System.out.print("Please enter the starting fish number: ");
		do{
			try {
				iNumber = input.nextInt();
				if (iNumber <=0 ) {
					System.out.printf("%d is not in the valid range, please enter a number greater than 0: ", iNumber);
				} else {
					inputOK = true;
				}
			} catch(InputMismatchException e) {
				dump = input.nextLine();
				System.out.printf("\"%s\" is not a valid integer, please try again: ", dump);
			}

		} while(inputOK!=true);

		return iNumber;
	}

	//get initial weight, returns double
	private static double getInitialWeight() {
		String dump = "";
		boolean inputOK = false;
		double iWeight = 0;

		System.out.print("Please enter the starting weight (grams) of the fish: ");
		do{
			try {
				iWeight = input.nextDouble();
				if (iWeight <=0 ) {
					System.out.printf("%.1f is not in the valid range, please enter a number greater than 0: ", iWeight);
				} else {
					inputOK = true;
				}
			} catch(InputMismatchException e) {
				dump = input.nextLine();
				System.out.printf("\"%s\" is not a valid weight, please try again: ", dump);
			}

		} while(inputOK!=true);

		return iWeight;
	}

	//get the temperature for interval i, returns double
	private static double getIntervalTemp(int i) {
		String dump = "";
		boolean inputOK = false;
		double temp = 0;

		System.out.printf("Please enter the temperature in Celcius (between 0 and 30) for interval #%d :",i+1);
		do{
			try {
				temp = input.nextDouble();
				if (temp < 0 || temp > 30) {
					System.out.printf("%.1f is not in the valid temperature range, please enter a temperature between 0 and 30: ", temp);
				} else {
					inputOK = true;
				}

			} catch(InputMismatchException e) {
				dump = input.nextLine();
				System.out.printf("\"%s\" is not a valid number, please try again: ", dump);
			}	

		} while(inputOK!=true);

		return temp;	
	}

	//get the interval time in days for interval i, returns integer
	private static int getIntervalDays(int i) {
		String dump = "";
		boolean inputOK = false;
		int day = 0;

		System.out.printf("Please enter the number of days (between 1 and 100) for interval #%d :", i+1);
		do{
			try {
				day = input.nextInt();
				if (day > 100 || day <= 0) {
					System.out.printf("%d is not in the valid range, please enter a integer between 1 and 100: ", day);	
				} else {
					inputOK = true;
				}
			} catch(InputMismatchException e) {
				dump = input.nextLine();
				System.out.printf("\"%s\" is not a valid integer, please try again: ", dump);
			}

		} while(inputOK!=true);

		return day;		
	}

}//end ModelFishFarm (non-OOP)
