import React from "react";
import { Card, Divider, Layout, Text, Icon } from "@ui-kitten/components";
import {
  SafeAreaView,
  View,
  StyleSheet,
  ScrollView,
  useWindowDimensions,
  Image
} from "react-native";
import { useDispatch, useSelector } from "react-redux";
import { globalConstants } from "../../constants";
import { globalStyles } from "../../shared/globalStyles";
import { ConfirmPaymentModal } from "../../components/Article";
import HTML from "react-native-render-html";
import { bikeOne } from "../../shared/generalAssets";
import { numberWithCommas } from "../../helpers/functions";





const BikeDetailsScreen = ({ navigation, route }) => {

  const bike = {
    name: 'Yello Red Bike',
    image: bikeOne,
    description: `
    <div style="color:#333;text-align:justify">
    <p  style="text-align:justify">This is where the description of the bike goes. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel animi, provident voluptate porro sit molestias eos voluptatem? Eos, dolores. Dolore quos atque tempora qui ad dignissimos corporis voluptatibus nam reiciendis.</p>
    </div>
`,
price: 3000,
location: "East Campus"
  }, Header = (props) => (
    <View {...props}>
        <Image source={bike.image} style={styles.thumb}></Image>
      
      <Divider />
      <Text category="h6" style={[globalStyles.mb20, globalStyles.textSecondary]}>
        {bike.name}
      </Text>
      <Text category="s1" style={globalStyles.textSmall}>
        Price Per Minute: {" "}
        <Text style={[globalStyles.textPrimary, globalStyles.textSmall]}>
        &#8358;{numberWithCommas(bike.price)}
        </Text>
      </Text>
    </View>
  );
  
  const contentWidth = useWindowDimensions().width;
  return (
    <SafeAreaView style={{ flex: 1 }}>
      <View
        style={[
          globalStyles.flexRow,
          globalStyles.justifySpaceBetween,
          styles.misc
        ]}
      >
        <Text style={globalStyles.textSmall}>  
        <Icon
                    style={styles.icon}
                    fill={globalConstants.PRIMARY_COLOR}
                    name='pin-outline'
                  /> Pick Point: {" "}
                  {bike.location}</Text>

        <ConfirmPaymentModal />
      </View>

      <ScrollView>
        <Layout style={[globalStyles.containerPadding, globalStyles.screenBg]}>
          <Card style={[styles.card]} status="warning" header={Header}>
            <HTML source={{ html: bike.description }} contentWidth={contentWidth} />
          </Card>
        </Layout>
      </ScrollView>
    </SafeAreaView>
  );
};
export default BikeDetailsScreen;

const styles = StyleSheet.create({
  card: {
    marginVertical: 10
  },
  misc: {
    width: globalConstants.SCREEN_WIDTH,
    padding: 20
  },
  icon: {
    height: 10,
    width: 10
  }, 
  thumb: {
    marginTop:30,
    width: "100%",
    height: 150
  },
});
