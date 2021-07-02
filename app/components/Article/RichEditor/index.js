import React from "react";
import { StyleSheet } from "react-native";
import QuillEditor from "react-native-cn-quill";
import { globalConstants } from "../../../constants";

export const RichEditor = ({ onChange }) => {
  const _editor = React.createRef();

  return (
    <QuillEditor
      style={styles.editor}
      ref={_editor}
      quill={{ placeholder: "Type here..." }}
      onHtmlChange={(e) => onChange(e.html)}
    />
  );
};

const styles = StyleSheet.create({
  editor: {
    borderColor: "gray",
    borderWidth: 1,
    marginVertical: 5,
    width: "100%",
    height: "auto",
    minHeight: (30 / 100) * globalConstants.SCREEN_HEIGHT
  }
});
